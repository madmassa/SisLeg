CREATE DEFINER=`root`@`localhost` FUNCTION `traerComisionesExpedienteParaTitulo`(_idDictamen int) RETURNS text CHARSET utf8mb4
BEGIN
	declare comisiones text default '';
    
    SELECT 	group_concat(c.comision separator '_')
    INTO	comisiones
    FROM 	dictamen as d
    LEFT
    JOIN	expedienteComision as ec
    ON		d.idDictamen=ec.idDictamenMayoria
    INNER
    JOIN	comision as c
    ON		c.idComision=ec.idComision
    WHERE	d.idDictamen=_idDictamen
	GROUP
    BY		d.idDictamen;
    
    if (comisiones='') then

		SELECT 	group_concat(c.comision separator '_')
		INTO	comisiones
		FROM 	dictamen as d
		LEFT
		JOIN	expedienteComision as ec
		ON		d.idDictamen=ec.idDictamenPrimeraMinoria
		INNER
		JOIN	comision as c
		ON		c.idComision=ec.idComision
		GROUP
		BY		d.idDictamen;
	end if;
    
    if (comisiones='') then

		SELECT 	group_concat(c.comision separator '_')
		INTO	comisiones
		FROM 	dictamen as d
		LEFT
		JOIN	expedienteComision as ec
		ON		d.idDictamen=ec.idDictamenSegundaMinoria
		INNER
		JOIN	comision as c
		ON		c.idComision=ec.idComision
		GROUP
		BY		d.idDictamen;
	end if;
			
RETURN replace(comisiones,',',' ');

END