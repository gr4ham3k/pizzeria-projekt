CREATE OR REPLACE FUNCTION get_cart(p_id_uzytkownika INT)
RETURNS TABLE (
    id_koszyka INT,
    id_uzytkownika INT,
    id_pizzy INT,
    id_dodatku INT,
    ilosc INT,
    cena_jednostkowa NUMERIC
) AS $$
BEGIN
    RETURN QUERY
    SELECT k.id_koszyka, k.id_uzytkownika, k.id_pizzy, k.id_dodatku, k.ilosc, k.cena_jednostkowa
    FROM koszyk as k
    WHERE k.id_uzytkownika = p_id_uzytkownika
    ORDER BY k.id_koszyka;
END;
$$ LANGUAGE plpgsql;