<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="2.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
<xsl:template match="/">
  <html>
    <head>
      <title>Exemple de sortie HTML</title>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    </head>
    <body>
		<xsl:for-each select="pathologies/pathologie" >
			<h1>Pathologie: <xsl:value-of select="./description" /></h1>
			<h2>Meridien:</h2>
				<p><xsl:value-of select="./meridien" /></p>
			<h2>Symptomes:</h2>
				<p><xsl:value-of select="concat('Nombre de Symptomes : ',count(./symptomes/symptome))" /></p>
			<ul>
				<xsl:for-each select="./symptomes/symptome" >
					<li><xsl:value-of select="." /></li>
				</xsl:for-each>
			</ul>
		</xsl:for-each>
    </body>
  </html>
</xsl:template>
</xsl:stylesheet>