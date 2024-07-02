<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Http;

class V3ReCaptcha implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        //
        $response = Http::get("https://www.google.com/recaptcha/api/siteverify",[
            'secret' => env('RECAPTCHAV3_SECRET_KEY'),
            'response' => $value
        ]);
        // dd($response->json());
  
        if (!($response->json()["success"] ?? false)) {
              $fail('The google recaptcha is required.');
        }
    }


    // php artisan make:rule V3ReCaptcha

}
