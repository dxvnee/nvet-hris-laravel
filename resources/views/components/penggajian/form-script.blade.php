@props([
    'user',
    'gajiPokok' => null,
    'totalMenitTelat' => 0,
    'potonganPerMenit' => 0,
    'totalMenitLembur' => 0,
    'upahLemburPerMenit' => 0,
    'totalTidakHadir' => 0,
    'potonganPerTidakHadir' => 0,
    'totalLupaPulang' => 0,
    'detail' => [],
    'lainLainItems' => [],
])

<script>
function penggajianForm() {
    return {
        gajiPokok: {{ $gajiPokok ?? $user->gaji_pokok }},
        totalMenitTelat: {{ $totalMenitTelat }},
        potonganPerMenit: {{ $potonganPerMenit }},
        totalMenitLembur: {{ $totalMenitLembur }},
        upahLemburPerMenit: {{ $upahLemburPerMenit }},
        totalTidakHadir: {{ $totalTidakHadir }},
        potonganPerTidakHadir: {{ $potonganPerTidakHadir }},
        lainLainItems: @json($lainLainItems),

        dokter: {
            transaksi: {{ $detail['transaksi'] ?? 0 }},
            persenan: {{ $detail['persenan'] ?? 0 }},
            pengurangan: {{ $detail['pengurangan'] ?? 0 }},
            penambahan: {{ $detail['penambahan'] ?? 0 }},
            lainLainItems: @json($detail['lain_lain_items'] ?? [])
        },

        paramedis: {
            antarJemputQty: {{ $detail['antar_jemput_qty'] ?? 0 }}, 
            antarJemputHarga: {{ $detail['antar_jemput_harga'] ?? 0 }},
            rawatInapQty: {{ $detail['rawat_inap_qty'] ?? 0 }}, 
            rawatInapHarga: {{ $detail['rawat_inap_harga'] ?? 0 }},
            visitQty: {{ $detail['visit_qty'] ?? 0 }}, 
            visitHarga: {{ $detail['visit_harga'] ?? 0 }},
            groomingQty: {{ $detail['grooming_qty'] ?? 0 }}, 
            groomingHarga: {{ $detail['grooming_harga'] ?? 0 }},
            lainLainItems: @json($detail['lain_lain_items'] ?? [])
        },

        fo: {
            reviewQty: {{ $detail['review_qty'] ?? 0 }}, 
            reviewHarga: {{ $detail['review_harga'] ?? 0 }},
            appointmentQty: {{ $detail['appointment_qty'] ?? 0 }}, 
            appointmentHarga: {{ $detail['appointment_harga'] ?? 0 }},
            lainLainItems: @json($detail['lain_lain_items'] ?? [])
        },

        tech: {
            antarKontenQty: {{ $detail['antar_konten_qty'] ?? 0 }}, 
            antarKontenHarga: {{ $detail['antar_konten_harga'] ?? 0 }},
            lainLainItems: @json($detail['lain_lain_items'] ?? [])
        },

        formatNumber(num) {
            return new Intl.NumberFormat('id-ID').format(num || 0);
        },

        calculateInsentifLainLainTotal(items) {
            return items.reduce((total, item) => {
                return total + ((parseInt(item.qty) || 0) * (parseFloat(item.harga) || 0));
            }, 0);
        },

        calculateLainLainTotal() {
            return this.lainLainItems.reduce((total, item) => {
                return total + (parseFloat(item.nilai) || 0);
            }, 0);
        },

        calculateDokterInsentif() {
            const transaksi = parseFloat(this.dokter.transaksi) || 0;
            const pengurangan = parseFloat(this.dokter.pengurangan) || 0;
            const penambahan = parseFloat(this.dokter.penambahan) || 0;
            const persenan = (parseFloat(this.dokter.persenan) || 0) / 100;
            const lainLain = this.calculateInsentifLainLainTotal(this.dokter.lainLainItems);
            return (transaksi - pengurangan + penambahan) * persenan + lainLain;
        },

        calculateParamedisInsentif() {
            const antarJemput = (parseInt(this.paramedis.antarJemputQty) || 0) * (parseFloat(this.paramedis.antarJemputHarga) || 0);
            const rawatInap = (parseInt(this.paramedis.rawatInapQty) || 0) * (parseFloat(this.paramedis.rawatInapHarga) || 0);
            const visit = (parseInt(this.paramedis.visitQty) || 0) * (parseFloat(this.paramedis.visitHarga) || 0);
            const grooming = (parseInt(this.paramedis.groomingQty) || 0) * (parseFloat(this.paramedis.groomingHarga) || 0);
            const lainLain = this.calculateInsentifLainLainTotal(this.paramedis.lainLainItems);
            return antarJemput + rawatInap + visit + grooming + lainLain;
        },

        calculateFOInsentif() {
            const review = (parseInt(this.fo.reviewQty) || 0) * (parseFloat(this.fo.reviewHarga) || 0);
            const appointment = (parseInt(this.fo.appointmentQty) || 0) * (parseFloat(this.fo.appointmentHarga) || 0);
            const lainLain = this.calculateInsentifLainLainTotal(this.fo.lainLainItems);
            return review + appointment + lainLain;
        },

        calculateTechInsentif() {
            const antarKonten = (parseInt(this.tech.antarKontenQty) || 0) * (parseFloat(this.tech.antarKontenHarga) || 0);
            const lainLain = this.calculateInsentifLainLainTotal(this.tech.lainLainItems);
            return antarKonten + lainLain;
        },

        getInsentif() {
            const jabatan = '{{ $user->jabatan }}';
            switch (jabatan) {
                case 'Dokter': return this.calculateDokterInsentif();
                case 'Paramedis': return this.calculateParamedisInsentif();
                case 'FO': return this.calculateFOInsentif();
                case 'Tech': return this.calculateTechInsentif();
                default: return 0;
            }
        },

        calculateTotal() {
            const gaji = parseFloat(this.gajiPokok) || 0;
            const potongan = (parseInt(this.totalMenitTelat) || 0) * (parseFloat(this.potonganPerMenit) || 0);
            const potonganLupaPulang = {{ $totalLupaPulang }} > 3 ? (parseFloat(this.potonganPerMenit) || 0) * 60 : 0;
            const potonganTidakHadir = (parseInt(this.totalTidakHadir) || 0) * (parseFloat(this.potonganPerTidakHadir) || 0);
            const insentif = this.getInsentif();
            const lembur = (parseInt(this.totalMenitLembur) || 0) * (parseFloat(this.upahLemburPerMenit) || 0);
            const lainLain = this.calculateLainLainTotal();
            return gaji - potongan - potonganLupaPulang - potonganTidakHadir + insentif + lembur + lainLain;
        }
    }
}
</script>
