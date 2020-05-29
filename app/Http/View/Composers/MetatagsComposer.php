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
        $this->setDefault($data, 'url', url()->current());
        $this->setDefault($data, 'imageUrl', "https://ru.lafeum.org/wp-content/uploads/2020/02/cropped-favi.png");

        $this->setDefault($data, 'article', null);

        if(array_key_exists('fullTitle', $data)){
            $data['title'] = $data['fullTitle'];
        
        } else if($data['title'] !== self::DEFAULT_TITLE) {
            
            $data['title'] .= self::TITLE_POSTFIX;
        }
        

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
}
