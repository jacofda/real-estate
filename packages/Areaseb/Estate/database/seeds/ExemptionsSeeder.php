<?php

use Illuminate\Database\Seeder;
use Areaseb\Estate\Models\Exemption;
use Illuminate\Support\Facades\Schema;

class ExemptionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Schema::disableForeignKeyConstraints();
        Exemption::truncate();
        Schema::enableForeignKeyConstraints();

        $fe16 = [
            "N1" => "escluse ex art. 15",
            "N2" => "non soggette (codice non più valido a partire dal primo gennaio 2021)",
            "N2.1" => "non soggette ad IVA ai sensi degli artt. da 7 a 7-septies del DPR 633/72",
            "N2.2" => "non soggette - altri casi",
            "N3" => "non imponibili (codice non più valido a partire dal primo gennaio 2021)",
            "N3.1" => "non imponibili - esportazioni",
            "N3.2" => "non imponibili - cessioni intracomunitarie",
            "N3.3" => "non imponibili - cessioni verso San Marino",
            "N3.4" => "non imponibili - operazioni assimilate alle cessioni all'esportazione",
            "N3.5" => "non imponibili - a seguito di dichiarazioni d'intento",
            "N3.6" => "non imponibili - altre operazioni che non concorrono alla formazione del plafond",
            "N4" => "esenti",
            "N5" => "regime del margine / IVA non esposta in fattura",
            "N6" => "inversione contabile (per le operazioni in reverse charge ovvero nei casi di autofatturazione per acquisti extra UE di servizi ovvero per importazioni di beni nei soli casi previsti) (codice non più valido a partire dal primo gennaio 2021)",
            "N6.1" => "inversione contabile - cessione di rottami e altri materiali di recupero",
            "N6.2" => "inversione contabile - cessione di oro e argento puro",
            "N6.3" => "inversione contabile - subappalto nel settore edile",
            "N6.4" => "inversione contabile - cessione di fabbricati",
            "N6.5" => "inversione contabile - cessione di telefoni cellulari",
            "N6.6" => "inversione contabile - cessione di prodotti elettronici",
            "N6.7" => "inversione contabile - prestazioni comparto edile e settori connessi",
            "N6.8" => "inversione contabile - operazioni settore energetico",
            "N6.9" => "inversione contabile - altri casi",
            "N7" => "IVA assolta in altro stato UE (vendite a distanza ex art. 40 c. 3 e 4 e art. 41 c. 1 lett. b, DL 331/93; prestazione di servizi di telecomunicazioni, tele-radiodiffusione ed elettronici ex art. 7-sexies lett. f, g, art. 74-sexies DPR 633/72)"
        ];

        $FeiC = [
            0 => ["valore_iva" => "22","descrizione_iva" => ""],
            1 => ["valore_iva" => "21","descrizione_iva" => ""],
            2 => ["valore_iva" => "20","descrizione_iva" => ""],
            3 => ["valore_iva" => "10","descrizione_iva" => ""],
            4 => ["valore_iva" => "4","descrizione_iva" => ""],
            6 => ["valore_iva" => "0","descrizione_iva" => ""],
            7 => ["valore_iva" => "0","descrizione_iva" => "Regime dei minimi"],
            9 => ["valore_iva" => "0","descrizione_iva" => "Fuori campo IVA"],
            10 => ["valore_iva" => "0","descrizione_iva" => "Oper. non soggetta, art.7 ter"],
            11 => ["valore_iva" => "0","descrizione_iva" => "Inversione contabile, art.7 ter"],
            12 => ["valore_iva" => "0","descrizione_iva" => "Non Imponibile"],
            13 => ["valore_iva" => "0","descrizione_iva" => "Non Imp. Art.8"],
            14 => ["valore_iva" => "0","descrizione_iva" => "Non Imp. Art.9 1C"],
            15 => ["valore_iva" => "0","descrizione_iva" => "Non Imp. Art.14 Legge 537/93"],
            16 => ["valore_iva" => "0","descrizione_iva" => "Non Imp. Art.41 D.P.R. 331/93"],
            17 => ["valore_iva" => "0","descrizione_iva" => "Non Imp. Art.72, D.P.R. 633/72"],
            18 => ["valore_iva" => "0","descrizione_iva" => "Non Imp. Art.74 quotidiani/libri"],
            19 => ["valore_iva" => "0","descrizione_iva" => "Escluso Art.10"],
            20 => ["valore_iva" => "0","descrizione_iva" => "Escluso Art.13 5C DPR 633/72"],
            21 => ["valore_iva" => "0","descrizione_iva" => "Escluso Art.15"],
            22 => ["valore_iva" => "0","descrizione_iva" => "Rev. charge art.17"],
            23 => ["valore_iva" => "0","descrizione_iva" => "Escluso Art.74 ter D.P.R. 633/72"],
            24 => ["valore_iva" => "0","descrizione_iva" => "Escluso Art.10 comma 1"],
            25 => ["valore_iva" => "0","descrizione_iva" => "Escluso Art.10 comma 20"],
            26 => ["valore_iva" => "0","descrizione_iva" => "Non Imp. Art.9"],
            27 => ["valore_iva" => "0","descrizione_iva" => "Escluso Art.10 n.27 D.P.R 633/72"],
            29 => ["valore_iva" => "8","descrizione_iva" => ""],
            30 => ["valore_iva" => "0","descrizione_iva" => "Regime del margine art.36 41/95"],
            31 => ["valore_iva" => "0","descrizione_iva" => "Escluso Art.3 comma 4 D.P.R 633/72"],
            32 => ["valore_iva" => "0","descrizione_iva" => "Escluso Art.15/1c D.P.R 633/72"],
            33 => ["valore_iva" => "0","descrizione_iva" => "Non imp. Art.8/c D.P.R. 633/72"],
            34 => ["valore_iva" => "0","descrizione_iva" => "Non Imp. Art.7 ter"],
            35 => ["valore_iva" => "0","descrizione_iva" => "Escluso Art.7 D.P.R 633/72"],
            36 => ["valore_iva" => "22","descrizione_iva" => "Esigibilita differita Art. 6 comma 5 D.P.R 633/72"],
            37 => ["valore_iva" => "0","descrizione_iva" => "Escluso Art.10 comma 9"],
            38 => ["valore_iva" => "0","descrizione_iva" => "Non imp. Art.7 quater DPR 633/72"],
            39 => ["valore_iva" => "0","descrizione_iva" => "Non Imp. Art.8 comma 1A"],
            40 => ["valore_iva" => "23","descrizione_iva" => ""],
            41 => ["valore_iva" => "24","descrizione_iva" => ""],
            42 => ["valore_iva" => "0","descrizione_iva" => "Non Imp. Art.2 comma 4 D.P.R 633/72"],
            43 => ["valore_iva" => "0","descrizione_iva" => "Non Imp. Art.18 633/72"],
            44 => ["valore_iva" => "0","descrizione_iva" => "Fuori Campo IVA Art.7 ter D.P.R 633/72"],
            45 => ["valore_iva" => "0","descrizione_iva" => "Non Imp. Art.10 n.18 DPR 633/72"],
            46 => ["valore_iva" => "0","descrizione_iva" => "Esente Art.10 DPR 633/72"],
            47 => ["valore_iva" => "0","descrizione_iva" => "Non imp. art.1 L. 244/2008"],
            48 => ["valore_iva" => "0","descrizione_iva" => "Non imp. art.40 D.L. 427/93"],
            49 => ["valore_iva" => "0","descrizione_iva" => "Non imp. art.41 D.L. 427/93"],
            50 => ["valore_iva" => "0","descrizione_iva" => "Non imp. art.71 DPR 633/72"],
            51 => ["valore_iva" => "0","descrizione_iva" => "Non imp. art.8 DPR 633/72"],
            52 => ["valore_iva" => "0","descrizione_iva" => "Non imp. art.9 DPR 633/72"],
            53 => ["valore_iva" => "0","descrizione_iva" => "Regime minimi 2015"],
            54 => ["valore_iva" => "5","descrizione_iva" => "Non imp. art.9 DPR 633/72"],
            55 => ["valore_iva" => "0","descrizione_iva" => "Non soggetta IVA"],
        ];


        foreach($fe16 as $codice => $nome)
        {
            Exemption::create([
                'nome' => $nome,
                'perc' => 0,
                'codice' => $codice,
                'connettore' => 'Aruba'
            ]);
        }

        foreach($FeiC as $codice => $value)
        {
            Exemption::create([
                'nome' => $value['descrizione_iva'],
                'perc' => $value['valore_iva'],
                'codice' => $codice,
                'connettore' => 'Fattura in Cloud'
            ]);
        }


    }
}
