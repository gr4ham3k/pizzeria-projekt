CREATE OR REPLACE FUNCTION get_single_pizza(p_id INT)
RETURNS TABLE (
    id_pizzy INT,
    nazwa VARCHAR,
    cena NUMERIC
)
LANGUAGE plpgsql
AS $$
BEGIN
    RETURN QUERY
    SELECT id_pizzy, nazwa, cena
    FROM pizze
    WHERE id_pizzy = p_id;
END;
$$;

