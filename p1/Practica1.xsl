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
		<link rel="stylesheet" type="text/css" href="css/transparentia/default.css"  media="screen"/>
		<title>CorporateNet</title>
	</head>
	<br/><br/>
	<body>
		<div class="container">
			<div class="main">
				<div class="header">
					<div class="title">
						<div class="logo1">CorporateNet</div>			
						 <div class="logo2">Red Profesional Corporativa</div>
					</div>
					
				</div>
				
				<div class="content">

				</div>
				
				<div class="sidenav">

					<h1>Aplicaciones</h1>
					<ul>
						<xsl:for-each select="CorporateNet/Aplicacion">
							<xsl:variable name = "rutaIcono"> <xsl:value-of select="@icono"/> </xsl:variable>
							<xsl:if test = "@nombre!='Buscador'">
							<li><div><img src = "{$rutaIcono}"/>  <a href="{$rutaIcono}"><xsl:value-of select="@nombre" /></a></div></li>
							</xsl:if>
						</xsl:for-each>
					</ul>
					
					<h1>Información Usuario</h1>
							<xsl:if test = "CorporateNet/Usuario/Perfil/DatosPersonales/@fotografia=''">
								<img src = "img/perfil/logoBlanco.gif"/> <br/>
                <a href="img/perfil/logoBlanco.gif">
                  <xsl:value-of select="CorporateNet/Usuario/Perfil/DatosPersonales/@apellido" />,
                  <xsl:value-of select="CorporateNet/Usuario/Perfil/DatosPersonales/@nombre" />
                </a>
							</xsl:if>
							<xsl:if test = "CorporateNet/Usuario/Perfil/DatosPersonales/@fotografia!=''">
								<xsl:variable name = "rutaFoto"> <xsl:value-of select="CorporateNet/Usuario/Perfil/DatosPersonales/@fotografia"/> </xsl:variable>
								<img src = "{$rutaFoto}"/> 	<br/>
                <a href="{$rutaFoto}">
                  <xsl:value-of select="CorporateNet/Usuario/Perfil/DatosPersonales/@apellido" />,
                  <xsl:value-of select="CorporateNet/Usuario/Perfil/DatosPersonales/@nombre" />
                </a>
              </xsl:if>


              <br/>
							<xsl:value-of select="CorporateNet/Usuario/Perfil/DatosProfesionales/@empresa" /><br/>
							<xsl:value-of select="CorporateNet/Usuario/Perfil/DatosProfesionales/@puesto" /><br/>
							<xsl:variable name = "rutaCV"><xsl:value-of select="CorporateNet/Usuario/Perfil/DatosProfesionales/@ficheroCV" /></xsl:variable>
							<a href="{$rutaCV}"> Currículum Vitae</a><br/>
							
					<h1>
						<xsl:for-each select="CorporateNet/Aplicacion">
						
						<xsl:if test = "@nombre='Buscador'">
							<xsl:variable name = "rutaIcono"> <xsl:value-of select="@icono"/> </xsl:variable>
							<img src = "{$rutaIcono}"/>  <xsl:value-of select="@nombre" />
						</xsl:if>
						</xsl:for-each>

						<div class= "menuRed"> Red </div>
					<input type="text" name="caja"></input>
					
					</h1>
				
				</div>
			</div>
		</div>
	</body>
</html>

</xsl:template>

<xsl:template name = "archivo2">
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="css/transparentia/default.css" media="screen"/>
		<title>CorporateNet</title>
	</head>
	<br/><br/>
	<body>
		<div class="container">
			<div class="main">
				<div class="header">
					<div class="title">
						<div class="logo1">CorporateNet</div>			
						 <div class="logo2">Red Profesional Corporativa</div>
					</div>
				</div>
				
				<div class="content">
					<div class="itemHeader">
						<h1>Lista de Contactos: <xsl:value-of select="count(CorporateNet/Usuario/Contacto)"/></h1>
					</div>
					<xsl:for-each select="CorporateNet/Usuario/Contacto">
						<div class="item">
	
							<div class="nombre"><xsl:value-of select="@nombre" /></div>
							<div class="puesto"><xsl:value-of select="@puesto" /></div>
							<div class="email"><xsl:value-of select="@email" /></div>
							<div class="red"><xsl:value-of select="@red" /></div>
						</div>
					</xsl:for-each>

				</div>
				
				<div class="sidenav">

					<h1>Aplicaciones</h1>
					<ul>
						<xsl:for-each select="CorporateNet/Aplicacion">
							<xsl:variable name = "rutaIcono"> <xsl:value-of select="@icono"/> </xsl:variable>
							<xsl:if test = "@nombre!='Buscador'">
							<li><div><img src = "{$rutaIcono}"/>  <a href="{$rutaIcono}"><xsl:value-of select="@nombre" /></a></div></li>
							</xsl:if>
						</xsl:for-each>
					</ul>
					
					<h1>Información Usuario</h1>
            <xsl:if test = "CorporateNet/Usuario/Perfil/DatosPersonales/@fotografia=''">
              <img src = "img/perfil/logoBlanco.gif"/>
              <br/>
              <a href="img/perfil/logoBlanco.gif">
                <xsl:value-of select="CorporateNet/Usuario/Perfil/DatosPersonales/@apellido" />,
                <xsl:value-of select="CorporateNet/Usuario/Perfil/DatosPersonales/@nombre" />
              </a>
            </xsl:if>
            <xsl:if test = "CorporateNet/Usuario/Perfil/DatosPersonales/@fotografia!=''">
              <xsl:variable name = "rutaFoto">
                <xsl:value-of select="CorporateNet/Usuario/Perfil/DatosPersonales/@fotografia"/>
              </xsl:variable>
              <img src = "{$rutaFoto}"/>
              <br/>
              <a href="{$rutaFoto}">
                <xsl:value-of select="CorporateNet/Usuario/Perfil/DatosPersonales/@apellido" />,
                <xsl:value-of select="CorporateNet/Usuario/Perfil/DatosPersonales/@nombre" />
              </a>
            </xsl:if>
							<br/>
							<xsl:value-of select="CorporateNet/Usuario/Perfil/DatosProfesionales/@empresa" /><br/>
							<xsl:value-of select="CorporateNet/Usuario/Perfil/DatosProfesionales/@puesto" /><br/>
							<xsl:variable name = "rutaCV"><xsl:value-of select="CorporateNet/Usuario/Perfil/DatosProfesionales/@ficheroCV" /></xsl:variable>
							<a href="{$rutaCV}"> Currículum Vitae</a><br/>
							
					<h1>
						<xsl:for-each select="CorporateNet/Aplicacion">
						
						<xsl:if test = "@nombre='Buscador'">
							<xsl:variable name = "rutaIcono"> <xsl:value-of select="@icono"/> </xsl:variable>
							<img src = "{$rutaIcono}"/>  <xsl:value-of select="@nombre" />
						</xsl:if>
						</xsl:for-each>

						<div class= "menuRed"> Red </div>
					<input type="text" name="caja"></input>
					
					</h1>
					
				</div>
			</div>
		</div>
	</body>
</html>

</xsl:template>


</xsl:stylesheet>