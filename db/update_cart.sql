CREATE OR REPLACE FUNCTION update_cart_item(
    p_id_koszyka INT,
    p_id_pizzy INT,
    p_id_dodatku INT,
    p_ilosc INT,
    p_cena_jednostkowa NUMERIC
)
RETURNS VOID AS $$
BEGIN
    UPDATE koszyk
    SET
        id_pizzy = p_id_pizzy,
        id_dodatku = p_id_dodatku,
        ilosc = p_ilosc,
        cena_jednostkowa = p_cena_jednostkowa
    WHERE id_koszyka = p_id_koszyka;
END;
$$ LANGUAGE plpgsql;
