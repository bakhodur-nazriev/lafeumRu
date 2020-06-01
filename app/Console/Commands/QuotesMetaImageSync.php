<?php

namespace App\Console\Commands;

use App\Quote;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Spatie\Browsershot\Browsershot;

class QuotesMetaImageSync extends Command
{
    const META_IMAGES_PATH = "/img/meta/";

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'quotes:sync-meta-image';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "Generates meta-image for quotes that doesn't have meta-image.";

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $quotes = Quote::all();

        foreach ($quotes as $quote) {
            
            if(!$quote->meta_image || !File::exists(public_path($quote->meta_image))){

                $this->comment("Generating image for quote with id:{$quote->id}...");
                
                $quote->meta_image = $this->getMetaImage($quote);
                $quote->save();

                $this->info("DONE!");
            }
        }

    }

    private function getMetaImage(Quote $quote)
    {
        $publicPath = static::META_IMAGES_PATH;
        
        $publicPath .= $quote->post->id . '.png';
        
        $path = public_path($publicPath);
        
        $html = view('layouts.quoteImage', compact('quote'))->render();

        $this->generateMetaImage($html, $path);

        return $publicPath;
    }

    private function generateMetaImage($html, $pathWithFile)
    {
        Browsershot::html($html)
            ->setNodeModulePath(env('NODE_MODULES_PATH'))
            ->setChromePath(env('CHROME_PATH'))
            ->waitUntilNetworkIdle()
            ->windowSize(1200, 628)
            ->save($pathWithFile);
    }
}
