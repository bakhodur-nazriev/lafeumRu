<?php

namespace App\Http\View\Composers;

use Illuminate\View\View;

class MetatagsComposer
{
    const DEFAULT_TITLE = "ЛАФЕЮМ";
    const TITLE_POSTFIX = " – " . self::DEFAULT_TITLE;

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $data = $view->getData();

        $this->setDefault($data, 'title', self::DEFAULT_TITLE);
        $this->setDefault($data, 'description', "");
        $this->setDefault($data, 'url', url()->full());
        $this->setDefault($data, 'imageUrl', url("/img/cropped-favi.png"));
        $this->setDefault($data, 'canonical', url()->current());

        $this->setDefault($data, 'article', null);

        if(array_key_exists('fullTitle', $data)){
            $data['title'] = $data['fullTitle'];
        
        } else if($data['title'] !== self::DEFAULT_TITLE) {
            
            $data['title'] .= self::TITLE_POSTFIX;
        }
        
        $data['schema'] = $this->getSchema($data);

        $view->with('data', $data);
    }

    /**
     * Helpers
     * 
     */

    private function setDefault(&$array, $key, $value)
    {
        if(!array_key_exists($key, $array)){
            $array[$key] = $value;
        }
    }

    private function getSchema($data)
    {
        return [
            "@context" => 'https://schema.org',
            "@graph" => [
                [
                    "@type" => "Organization",
                    "@id" => url('/#organization'),
                    "name" => "ЛАФЕЮМ",
                    "url" => url('/'),
                    "sameAs" => [],
                    "logo" => [
                        "@type" => "ImageObject",
                        "@id" => url('/#logo'),
                        "url" =>  url("/img/lafeum-ru-about-1.png"),
                        "width" => 600,
                        "height" => 382,
                        "caption" => "ЛАФЕЮМ"
                    ],
                    "image" => [
                        "@id" => url('/#logo')
                    ]
                ],
                [
                    "@type" => "WebSite",
                    "@id" => url('/#website'),
                    "url" => url('/'),
                    "name" => "ЛАФЕЮМ",
                    "publisher" => [
                        "@id" => url('/#organization')
                    ],
                    "potentialAction" => [
                        "@type" => "SearchAction",
                        "target" => url('/?s={search_term_string}'),
                        "query-input" => "required name=search_term_string"
                    ]
                ],
                [
                    "@type" => "CollectionPage",
                    "@id" => url('/#website'),
                    "url" => url()->current(),
                    "inLanguage" => "ru-RU",
                    "name" => $data['title'],
                    "isPartOf" => [
                        "@id" => url('/#website')
                    ],
                    "about" => [
                        "@id" => url('/#organization')
                    ],
                    "description" => isset($data['description']) ? $data['description']: "",
                ]
            ]
        ];
    }
}
