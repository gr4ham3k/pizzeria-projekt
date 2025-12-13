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
    SELECT 
        p.id_pizzy,
        p.nazwa,
        p.cena
    FROM pizze p
    WHERE p.id_pizzy = p_id;
END;
$$;
