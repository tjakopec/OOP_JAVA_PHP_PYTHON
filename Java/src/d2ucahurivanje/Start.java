package d2ucahurivanje;

public class Start {

    public  Start(){
        Dokument dokument = new Dokument();
        dokument.setSifra(1);
        dokument.setBrojDokumenta("2020-001");
        dokument.setIznos(1200.34);
        System.out.println(dokument.opisiMe());


        dokument = new Dokument(2,"2020-002",100);
        System.out.println(dokument.opisiMe());


        System.out.println(new Dokument(3,"2020-003",200).opisiMe());


    }

    public static void main(String[] args) {
        new Start();
    }
}
