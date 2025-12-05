CREATE OR REPLACE FUNCTION finalize_order(
    p_user_id integer,
    p_name text,
    p_surname text,
    p_phone text,
    p_city text,
    p_road text,
    p_building text,
    p_apartment text,
    p_totalPrice decimal
)
RETURNS integer
LANGUAGE plpgsql
AS $$
DECLARE
    v_order_id integer;
BEGIN
    v_order_id := create_order(
        p_user_id,
        p_name, p_surname, p_phone,
        p_city, p_road, p_building, p_apartment, p_totalPrice
    );

    PERFORM add_cart_to_order(v_order_id, p_user_id);

    PERFORM clear_cart(p_user_id);

    RETURN v_order_id;
END;
$$;
