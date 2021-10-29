<?php

namespace App\Http\Controllers;

use App\Feedback;
use App\Mail\ContactMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use GuzzleHttp\Client;

class FeedbacksController extends Controller
{
    public function create()
    {
        return view("/contacts");
    }

    public function get(Request $request)
    {
        return Feedback::latest()->paginate($request->perPage ?: 15);
    }

    public function store(Request $request)
    {
        $data = request()->validate([
            "user_name" => "required",
            "user_email" => "required|email",
            "topic" => "required",
            "message" => "required"
        ]);

        Feedback::create($data);

        $token = $request->input('g-recaptcha-response');
        if ($token) {
            $client = new Client();
            $response = $client->post('https://www.google.com/recaptcha/api/siteverify', [
                'form_params' => array(
                    'secret' => '6LeXjvscAAAAAPm3_smOoiWBJXbbMGQz6KSYlobW',
                    'response' => $token
                )
            ]);
            $result = json_decode($response->getBody()->getContents());

            if ($result->success) {
                return redirect("/contacts")->with('message', 'Спасибо! Ваше письмо успешно отправлено!');
            } else {
                return redirect("/contacts")->with('message', 'Ошибка! Вероятно вы робот');
            }
        } else {
            redirect('/contacts');
        }

        Mail::to('bakhodur.nazriev@gmail.com')->send(new ContactMail($data));
    }

    public function destroy(Feedback $feedback)
    {
        $feedback->delete();
    }
}
