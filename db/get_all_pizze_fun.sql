CREATE OR REPLACE FUNCTION get_all_pizze()
RETURNS TABLE (
    id_pizzy INT,
    nazwa VARCHAR,
    cena NUMERIC,
    zdjecie_sciezka VARCHAR
) AS $$
BEGIN
    RETURN QUERY
    SELECT p.id_pizzy, p.nazwa, p.cena, p.zdjecie_sciezka
    FROM pizze AS p
    ORDER BY p.id_pizzy;
END;
$$ LANGUAGE plpgsql;
