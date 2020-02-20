package model;

public class PartijaTriIgraca extends PartijaDvaIgraca {

    @Override
    public String toString() {
        Rezulat rezulat = getRezultat();
        return "Partija TRI IGRAČA, igra gotova: " + isIgraGotova() + ", " +
                getIgraci().get(0) + ": " + rezulat.getPrvi() +" | "+
                getIgraci().get(1) + ": " + rezulat.getDrugi() + " | "+
                 getIgraci().get(2) + ": " + rezulat.getTreci();
    }


    public Rezulat getRezultat() {
        Rezulat rezulat = new Rezulat(getMjesanja().stream().mapToInt(x -> x.getRezultat().getPrvi()).sum(),
                getMjesanja().stream().mapToInt(x -> x.getRezultat().getDrugi()).sum(),
                getMjesanja().stream().mapToInt(x -> x.getRezultat().getTreci()).sum());
        return rezulat;
    }
}
