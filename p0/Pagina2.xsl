<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version ="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
               xmlns:xt="http://www.jclark.com/xt"
               extension-element-prefixes="xt">
<xsl:output method="xml" version="1.0" encoding="UTF-8" indent="yes"/>
<xsl:template match="/">
<html>
<head>CorporateNet</head>
<br/><br/>
<body>
<xsl:for-each select="CorporateNet/Aplicacion">
	<xsl:if test = "@nombre!='Buscador'">
		<xsl:value-of select="@icono" /> <xsl:value-of select="@nombre" /> <br/>
	</xsl:if>
	
</xsl:for-each>
<xsl:if test = "CorporateNet/Usuario/Perfil/DatosPersonales/@fotografia=''">
  "../img/logoBlanco.jpg"<br/>
</xsl:if>
<xsl:if test = "CorporateNet/Usuario/Perfil/DatosPersonales/@fotografia!=''">
  <xsl:value-of select="CorporateNet/Usuario/Perfil/DatosPersonales/@fotografia" /><br/>
</xsl:if>

<xsl:value-of select="CorporateNet/Usuario/Perfil/DatosPersonales/@nombre" />
<xsl:value-of select="CorporateNet/Usuario/Perfil/DatosPersonales/@apellido" /><br/>
<xsl:value-of select="CorporateNet/Usuario/Perfil/DatosProfesionales/@empresa" /><br/>
<xsl:value-of select="CorporateNet/Usuario/Perfil/DatosProfesionales/@puesto" /><br/>
<xsl:value-of select="CorporateNet/Usuario/Perfil/DatosProfesionales/@ficheroCV" /><br/>

<xsl:for-each select="CorporateNet/Aplicacion">
	<xsl:if test = "@nombre='Buscador'">
		<xsl:value-of select="@nombre" /> 
	</xsl:if>
</xsl:for-each>
Red <br/>
<input type="text" name="caja"></input>

Lista de Contactos: 
<xsl:value-of select="count(CorporateNet/Usuario/Contacto)"/><br/>

<xsl:for-each select="CorporateNet/Usuario/Contacto">
<xsl:value-of select="@nombre" />
<xsl:value-of select="@puesto" /> <br/>
<xsl:value-of select="@email" /><br/>
<xsl:value-of select="@red" /><br/>
		
</xsl:for-each>




</body>
</html>
</xsl:template>
</xsl:stylesheet>