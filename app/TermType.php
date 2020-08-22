<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TermType extends Model
{
    public $timestamp = false;
    protected $fillable = ["name"];

    const SCIENTIFIC_TERMS = "Термины научного мира";
    const EXPERT_COMMENTS = "Комментарии специалистов";

    public function terms()
    {
        return $this->hasMany(Term::class);
    }
}
