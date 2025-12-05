CREATE OR REPLACE FUNCTION add_pizza_to_order(
    p_order_id integer,
    p_pizza_id integer,
    p_quantity integer,
    p_price numeric,
    p_dodatek_id integer DEFAULT NULL
)
RETURNS integer
LANGUAGE plpgsql
AS $$
DECLARE
    v_order_pizza_id integer;
BEGIN
    INSERT INTO zamowienie_pizze (
        id_zamowienia, id_pizzy, ilosc, cena_pizzy, id_dodatku
    )
    VALUES (
        p_order_id, p_pizza_id, p_quantity, p_price, p_dodatek_id
    )
    RETURNING id_zamowienia_pizzy INTO v_order_pizza_id;

    RETURN v_order_pizza_id;
END;
$$;
