CREATE TABLE klienci (

	id_klienta SERIAL PRIMARY KEY,
	imie VARCHAR(30) NOT NULL,
	nazwisko VARCHAR(30) NOT NULL,
	telefon VARCHAR(15) NOT NULL,
	adres VARCHAR(100) NOT NULL
	
);

CREATE TABLE pizze (

	id_pizzy SERIAL PRIMARY KEY,
	nazwa VARCHAR(50),
	cena NUMERIC(6,2)
	
);

CREATE TABLE dodatki (

	id_dodatku SERIAL PRIMARY KEY,
	nazwa VARCHAR(50) NOT NULL,
	cena_dodatkowa NUMERIC(5,2) DEFAULT 0
	
);

CREATE TABLE zamowienia (
    id_zamowienia SERIAL PRIMARY KEY,
    id_klienta INTEGER REFERENCES klienci(id_klienta),
    data_zamowienia TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    status VARCHAR(20) DEFAULT 'złożone',
    cena_calkowita NUMERIC(8,2)
);

CREATE TABLE zamowienie_pizze (
    id_zamowienia_pizzy SERIAL PRIMARY KEY,
    id_zamowienia INTEGER REFERENCES zamowienia(id_zamowienia),
    id_pizzy INTEGER REFERENCES pizze(id_pizzy),
    ilosc INTEGER DEFAULT 1,
    cena_pizzy NUMERIC(6,2)
);

CREATE TABLE zamowienie_dodatki (
    id_zamowienia_dodatku SERIAL PRIMARY KEY,
    id_zamowienia_pizzy INTEGER REFERENCES zamowienie_pizze(id_zamowienia_pizzy),
    id_dodatku INTEGER REFERENCES dodatki(id_dodatku),
    ilosc INTEGER DEFAULT 1
);