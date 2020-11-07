<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
<xsl:template match="/">
<html> 
<body>
<!--https://www.w3schools.com/xml/tryxslt.asp?xmlfile=cdcatalog&xsltfile=cdcatalog-->
  <table border="1">
    <tr bgcolor="#9acd32">
		<th>Autor</th>
		<th>Enunciado</th>
		<th>Respuesta correcta</th>
		<th>Respuestas incorrectas</th>
		<th>Tema</th>
    </tr>
    <xsl:for-each select="assessmentItems/assessmentItem">
    <tr>
	  <td><xsl:value-of select="@author" /></td>
      <td><xsl:value-of select="itemBody/p"/></td>
      <td style="text-align: center;"><xsl:value-of select="correctResponse/response"/></td>
      <td>
	  <br/>
	  <ul>
		<xsl:for-each select="incorrectResponses/response">
			<li><xsl:value-of select="current()"/></li>
		</xsl:for-each>
	  </ul>
	  </td>
	  <td><xsl:value-of select="@subject" /></td>
    </tr>
    </xsl:for-each>
  </table>
</body>
</html>
</xsl:template>
</xsl:stylesheet>

