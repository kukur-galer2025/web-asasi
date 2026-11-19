<?php

namespace Tests\Feature;

use Illuminate\Support\ViewErrorBag;
use Tests\TestCase;

class RekeningInfoTest extends TestCase
{
    public function test_official_bank_account_is_shown_on_payment_form(): void
    {
        $html = view('frontend.partials.payment-fields', ['jenis' => 'pendaftaran', 'errors' => new ViewErrorBag])->render();

        $this->assertStringContainsString('Bank Syariah Indonesia (BSI)', $html);
        $this->assertStringContainsString('7888854546', $html);
        $this->assertStringContainsString('a.n. Akademisi dan Saintis Indonesia', $html);
        $this->assertStringContainsString('Salin No. Rekening', $html);
        $this->assertStringNotContainsString('dapat diperoleh melalui Sekretariat', $html);
    }

    public function test_falls_back_to_secretariat_note_when_account_is_blank(): void
    {
        config(['asasi.rekening.nomor' => '']);

        $html = view('frontend.partials.payment-fields', ['jenis' => 'perpanjangan', 'errors' => new ViewErrorBag])->render();

        $this->assertStringContainsString('dapat diperoleh melalui Sekretariat', $html);
    }
}
