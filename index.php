<!DOCTYPE html>
<html lang="cs-cz">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Kalendář</title>
</head>
<body>

    <h3 id="mesicRok">Měsíc a rok</h3>
    <table>
        <thead>
            <tr>
                <th>Pondělí</th>
                <th>Úterý</th>
                <th>Středa</th>
                <th>Čtvrtek</th>
                <th>Pátek</th>
                <th>Sobota</th>
                <th>Neděle</th>
            </tr>
            <tbody id="kalendar"></tbody>
        </thead>
    </table>

    <button onclick="predchozi();">Předchozí</button>
    <button onclick="nasledujici();">Následující</button>
    
    <script>

        let dnes = new Date();
        let aktualniMesic = dnes.getMonth();
        let aktualniRok = dnes.getFullYear();

        let mesice = ["Leden", "Únor", "Březen", "Duben", "Květen", "Červen", "Červenec", "Srpen", "Září", "Říjen", "Listopad", "Prosinec"];

        let mesicRok = document.getElementById('mesicRok');

        zobrazitKalendar(aktualniMesic, aktualniRok);

        function zobrazitKalendar(mesic, rok) {
            let prvniDen = (new Date(rok, mesic)).getDay();
            console.log(prvniDen);
            let dnyVMesici = 32 - new Date(rok, mesic, 32).getDate();

            let tabulka = document.getElementById('kalendar');

            tabulka.innerHTML = "";

            mesicRok.innerHTML = mesice[mesic] + " " + rok

            let datum = 1;

            for (let i = 0; i < 6; i++) {
                let radek = document.createElement('tr');

                for (let j = 0; j < 7; j++) {   
                    if(i === 0 && j < prvniDen-1) {
                        let bunka = document.createElement('td');
                        let bunkaText = document.createTextNode("");
                        bunka.appendChild(bunkaText);
                        radek.appendChild(bunka);                         
                    } else if(datum > dnyVMesici) {
                         break;
                    } else {
                        let bunka = document.createElement('td');
                        let bunkaText = document.createTextNode(datum);

                        if (datum === dnes.getDate() && rok === dnes.getFullYear() && mesic === dnes.getMonth()) {
                            bunka.style.background = "lightgreen";
                        }

                        let datumBunka = new Date(rok, mesic, datum);

                        bunka.appendChild(bunkaText);
                        radek.appendChild(bunka); 
                        datum++; 
                    }

                    
                }

                tabulka.appendChild(radek);
            }
        }

        function nasledujici() {
            aktualniRok = (aktualniMesic === 11) ? aktualniRok + 1 : aktualniRok;
            aktualniMesic = (aktualniMesic + 1) % 12;
            zobrazitKalendar(aktualniMesic, aktualniRok);
        }

        function predchozi() {
            aktualniRok = (aktualniMesic === 0) ? aktualniRok - 1 : aktualniRok;
            aktualniMesic = (aktualniMesic === 0) ? 11 : aktualniMesic - 1;
            zobrazitKalendar(aktualniMesic, aktualniRok);
        }

    </script>
</body>
</html>