CREATE OR REPLACE FUNCTION clear_cart(
    p_user_id integer
)
RETURNS void
LANGUAGE plpgsql
AS $$
BEGIN
    DELETE FROM koszyk WHERE id_uzytkownika = p_user_id;
END;
$$;
