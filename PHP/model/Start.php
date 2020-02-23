<?php



namespace model;

//Ovo je teški fail ali radi
require_once 'Entitet.php';
require_once 'Igrac.php';
require_once 'Lokacija.php';
require_once 'Rezultat.php';
require_once 'Mjesanje.php';
require_once 'MjesanjeDvaUnosa.php';
require_once 'MjesanjeTriUnosa.php';
require_once 'Partija.php';
require_once 'PartijaDvaIgraca.php';
require_once 'PartijaTriIgraca.php';
require_once 'PartijaDvaPara.php';


class Start
{
    public function __construct()
    {
        // $e = new Entitet(); //Cannot instantiate abstract class 'Entitet'
        foreach ($this->getPartije() as $partija) {
            echo  $partija  . "\n";
        }
        print_r($this->getPartije());
    }

    private function getPartije(): array
    {
        $partije = [];
        $podaci = json_decode(file_get_contents("../podaci.json"));
        foreach ($podaci as $p) {
            $partija = new PartijaDvaIgraca();
            switch (count($p->igraci)) {
                case 2:
                    $partija = new PartijaDvaIgraca();
                    break;
                case 3:
                    $partija = new PartijaTriIgraca();
                    break;
                case 4:
                    $partija = new PartijaDvaPara();
                    break;
            }
            $partija->setId($p->id);
            $partija->setDoKolikoSeIgra($p->doKolikoSeIgra);

            $unosi = new Igrac();
            $unosi->setId($p->unosi->id);
            $unosi->setIme($p->unosi->ime);
            $unosi->setPrezime($p->unosi->prezime);
            $unosi->setSpol($p->unosi->spol);
            $partija->setUnosi($unosi);

            $lokacija = new Lokacija();
            $lokacija->setId($p->lokacija->id);
            $lokacija->setLongitude($p->lokacija->longitude);
            $lokacija->setLatitude($p->lokacija->latitude);
            $lokacija->setNaziv($p->lokacija->naziv);
            $partija->setLokacija($lokacija);

            $igraci=[];
            foreach ($p->igraci as $i) {
                $igrac = new Igrac();
                $igrac->setId($i->id);
                $igrac->setIme($i->ime);
                $igrac->setPrezime($i->prezime);
                $igrac->setSpol($i->spol);
                $igraci[] = $igrac;
            }
            $partija->setIgraci($igraci);

            $mjesanja=[];
            foreach ($p->mjesanja as $m) {

                if (isset($m->bodovaTreciUnos)) {
                    $mjesanje = new MjesanjeTriUnosa();
                    $mjesanje->setBodovaTreciUnos($m->bodovaTreciUnos);
                    $mjesanje->setZvanjeTreciUnos($m->zvanjeTreciUnos);
                } else {
                    $mjesanje = new MjesanjeDvaUnosa();
                }


                $mjesanje->setId($m->id);
                $mjesanje->setStiglja($m->stiglja);
                $mjesanje->setBelot($m->belot);
                $mjesanje->setDatumUnosa(new \DateTime($m->datumUnosa));
                $mjesanje->setBodovaPrviUnos($m->bodovaPrviUnos);
                $mjesanje->setZvanjePrviUnos($m->zvanjePrviUnos);
                $mjesanje->setBodovaDrugiUnos($m->bodovaDrugiUnos);
                $mjesanje->setZvanjeDrugiUnos($m->zvanjeDrugiUnos);

                $mjesanja[] = $mjesanje;
            }
            $partija->setMjesanja($mjesanja);


            $partije[] = $partija;

        }
        return $partije;
    }

}

new Start();