CREATE OR REPLACE FUNCTION create_order(
    p_user_id integer,
    p_name text,
    p_surname text,
    p_phone text,
    p_city text,
    p_road text,
    p_building text,
    p_apartment text
)
RETURNS integer
LANGUAGE plpgsql
AS $$
DECLARE
    v_order_id integer;
BEGIN
    INSERT INTO zamowienia (
        id_uzytkownika,
        imie, nazwisko, telefon,
        miasto, ulica, numer_budynku, numer_mieszkania,
        data_zamowienia, status
    )
    VALUES (
        p_user_id,
        p_name, p_surname, p_phone,
        p_city, p_road, p_building, p_apartment,
        CURRENT_TIMESTAMP, 'złożone'
    )
    RETURNING id_zamowienia INTO v_order_id;

    RETURN v_order_id;
END;
$$;
