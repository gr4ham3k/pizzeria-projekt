CREATE OR REPLACE FUNCTION public.get_all_dodatki()
RETURNS TABLE(
    id_dodatku integer,
    nazwa character varying,
    cena_dodatkowa numeric
) 
LANGUAGE plpgsql
AS $$
BEGIN
    RETURN QUERY
    SELECT 
        d.id_dodatku,
        d.nazwa,
        d.cena_dodatkowa
    FROM public.dodatki d
    ORDER BY d.id_dodatku;
END;
$$;