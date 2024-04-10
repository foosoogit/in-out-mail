<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Student;
use Illuminate\Mail\Mailables\Address;
use App\Http\Controllers\OtherFunc;
use Illuminate\Mail\Mailables\Headers;

class ContactMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    //public function __construct(public Student $student)
    public function __construct(public array $target_item_array)
    {
        //$student->name
        //$this->target_item = $content;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        //print 'jyuku_name='.$this->target_item_array['jyuku_name']."<br>";
        //$from    = new Address($this->target_item_array['from_email']);
        //$from    = new Address($this->target_item_array['from_email'], $this->target_item_array['jyuku_name']);
        //$subject = $this->target_item_array['name_sei'].' '.$this->target_item_array['name_mei'].'さんが'.$this->target_item_array['type'].'されました。';
        //$from= new Address($this->target_item_array['from_email'], $this->target_item_array['jyuku_name']);
        //$subject = $this->target_item_array['subject'];
        //$subject=str_replace('[name-protector]', OtherFunc::randomName(), $msg);
        //$subject = $this->target_item_array['subject'];
        //$from    = new Address($target_item_array['email'], $target_item_array['protector']);
        //$subject = $target_item_array['name_sei'].' '.$target_item_array['name_mei'].'さんが'.$$target_item_array['type'].'入室されました。';
        return new Envelope(
            /*
            'host' => 'smtp.gmail.com',
            'port' => '465',
            'username' => 'hogehoge@gmail.com',
            'password' => 'passpasspasspass',
            'encryption' => 'ssl',
            */
            subject: $this->target_item_array['subject'],
            //'from' => ['address' => 'foosoo200@gmail.com', 'name' => 'foosoo200'],
            //from: new Address('foosoo200@gmail.com'),
            //from: new Address($this->target_item_array['from_email'], 'Jeffrey Way'),
            //from: $this->target_item_array['from_email'],
            //from: new Address($this->target_item_array['from_email'], $this->target_item_array['jyuku_name']),
            to: $this->target_item_array['to_email'],
            //message:$this->target_item_array['msg'],
            //replyTo:$this->target_item_array['from_email'],
            replyTo: $this->target_item_array['from_email'],
        );

    }
    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(
            markdown: 'emails.contact',
            //text: $this->target_item_array['msg'],
            text: 'emails.contact',
            //html: 'emails.contact',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }
}
