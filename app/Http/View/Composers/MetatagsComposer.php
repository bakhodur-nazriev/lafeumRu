<?php

namespace App\Http\View\Composers;

use Illuminate\View\View;

class MetatagsComposer
{
    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $data = $view->getData();

        $this->setDefault($data, 'title', "ЛАФЕЮМ");
        $this->setDefault($data, 'description', "");
        $this->setDefault($data, 'url', url()->current());
        $this->setDefault($data, 'imageUrl', "https://ru.lafeum.org/wp-content/uploads/2020/02/cropped-favi.png");

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
