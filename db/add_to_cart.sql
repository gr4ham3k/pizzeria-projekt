CREATE OR REPLACE FUNCTION add_to_cart(p_id_uzytkownika INTEGER,
p_id_pizzy INTEGER, p_id_dodatku INTEGER, p_ilosc INTEGER, p_cena NUMERIC(6,2))
RETURNS VOID
AS $$
BEGIN
    INSERT INTO koszyk (id_uzytkownika, id_pizzy, id_dodatku, ilosc, cena_jednostkowa)
    VALUES (p_id_uzytkownika, p_id_pizzy, p_id_dodatku, p_ilosc, p_cena);
END;
$$ LANGUAGE plpgsql;