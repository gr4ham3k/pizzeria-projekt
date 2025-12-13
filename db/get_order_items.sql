CREATE OR REPLACE FUNCTION get_order_items(order_id integer)
RETURNS TABLE (
    ilosc integer,
    cena numeric,
    produkt text,
    dodatek text
) AS $$
BEGIN
    RETURN QUERY
    SELECT
        zp.ilosc,
        zp.cena_pizzy AS cena,
        p.nazwa::text AS produkt,
        COALESCE(d.nazwa, '')::text AS dodatek
    FROM zamowienie_pizze zp
    JOIN pizze p ON zp.id_pizzy = p.id_pizzy
    LEFT JOIN dodatki d ON zp.id_dodatku = d.id_dodatku
    WHERE zp.id_zamowienia = order_id
    ORDER BY zp.id_zamowienia_pizzy;
END;
$$ LANGUAGE plpgsql;
