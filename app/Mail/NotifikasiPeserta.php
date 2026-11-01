<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;

class NotifikasiPeserta extends Mailable
{
    public function __construct(
        public string $subjek,
        public string $nama,
        public string $judul,
        public array $baris,
        public ?string $catatan = null,
        public ?string $tombolTeks = null,
        public ?string $tombolUrl = null,
    ) {
    }

    public function envelope(): Envelope
    {
        return new Envelope(subject: $this->subjek);
    }

    public function content(): Content
    {
        return new Content(view: 'emails.notifikasi', text: 'emails.notifikasi-text');
    }
}
