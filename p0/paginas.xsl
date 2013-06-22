<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version ="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
               xmlns:xt="http://www.jclark.com/xt"
               extension-element-prefixes="xt">
<xsl:output method="xml" version="1.0" encoding="UTF-8" indent="yes"/>


<xsl:variable name = "file1"> pag1 </xsl:variable>
<xsl:variable name = "file2"> pag2 </xsl:variable>
<xsl:template match="/">
	<xt:document method = "html" href = "{$file1}.html">
		<xsl:call-template name = "archivo1"/>
	</xt:document>
	<xt:document method = "html" href = "{$file2}.html">
		<xsl:call-template name ="archivo2"/>
	</xt:document>
</xsl:template>

<xsl:template name = "archivo1">
<html>
<head>
<link rel="stylesheet" type="text/css" href="css/transparentia/default.css"/>

<title>CorporateNet</title>


</head>
<br/><br/>
<body>
<div class="container">
	
	<div class="main">

		<div class="header">
		
			<div class="title">
				<h1>Transparentia</h1>
			</div>

		</div>
		
		<div class="content">

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

</div>
		
	</div>
</div>

</body>
</html>


</xsl:template>

<xsl:template name = "archivo2">

<html>
<head>
<link rel="stylesheet" type="text/css" href="css/transparentia/default.css"/>

<title>CorporateNet</title>


</head>
<br/><br/>
<body>
<h1>CorporateNet</h1>
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