CREATE OR REPLACE FUNCTION add_cart_to_order(
    p_order_id integer,
    p_user_id integer
)
RETURNS void
LANGUAGE plpgsql
AS $$
DECLARE
    v_item record;
BEGIN
    FOR v_item IN
        SELECT * FROM koszyk WHERE id_uzytkownika = p_user_id
    LOOP
        PERFORM add_pizza_to_order(
            p_order_id,
            v_item.id_pizzy,
            v_item.ilosc,
            v_item.cena_jednostkowa,
            v_item.id_dodatku
        );
    END LOOP;
END;
$$;
