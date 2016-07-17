<Page id="1" templateExtension="html" relativePath="." fullRelativePath="." secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" isService="False" cachingEnabled="False" cachingDuration="1 minutes" wizardTheme="Simple" wizardThemeVersion="3.0" pasteActions="pasteActions" needGeneration="0">
	<Components>
		<Grid id="2" secured="False" sourceType="SQL" returnValueType="Number" defaultPageSize="1000" connection="Connection1" dataSource="SELECT * 
FROM certificados,clave
WHERE replace(nro,' ','') = '{s_protocolo}' 
and (nrodoc = '{s_nrodoc}' OR clave = '{s_nrodoc}' )" name="certificados" pageSizeLimit="1000" wizardCaption=" Certificados Lista de" wizardGridType="Tabular" wizardSortingType="SimpleDir" wizardAllowInsert="False" wizardAltRecord="False" wizardAltRecordType="Style" wizardRecordSeparator="False" wizardNoRecords="No hay registros" activeCollection="SQLParameters" parameterTypeListName="ParameterTypeList">
			<Components>
				<Sorter id="3" visible="True" name="Sorter_nro" column="nro" wizardCaption="Nro" wizardSortingType="SimpleDir" wizardControl="nro" wizardAddNbsp="False" PathID="certificadosSorter_nro">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="4" visible="True" name="Sorter_nombre" column="nombre" wizardCaption="Nombre" wizardSortingType="SimpleDir" wizardControl="nombre" wizardAddNbsp="False" PathID="certificadosSorter_nombre">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="5" visible="True" name="Sorter_fecha" column="fecha" wizardCaption="Fecha" wizardSortingType="SimpleDir" wizardControl="fecha" wizardAddNbsp="False" PathID="certificadosSorter_fecha">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="6" visible="True" name="Sorter_sexo" column="sexo" wizardCaption="Sexo" wizardSortingType="SimpleDir" wizardControl="sexo" wizardAddNbsp="False" PathID="certificadosSorter_sexo">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="7" visible="True" name="Sorter_tipodoc" column="tipodoc" wizardCaption="Tipodoc" wizardSortingType="SimpleDir" wizardControl="tipodoc" wizardAddNbsp="False" PathID="certificadosSorter_tipodoc">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="8" visible="True" name="Sorter_nrodoc" column="nrodoc" wizardCaption="Nrodoc" wizardSortingType="SimpleDir" wizardControl="nrodoc" wizardAddNbsp="False" PathID="certificadosSorter_nrodoc">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Label id="9" fieldSourceType="DBColumn" dataType="Text" html="False" name="nro" fieldSource="nro" wizardCaption="Nro" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="certificadosnro">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="10" fieldSourceType="DBColumn" dataType="Text" html="False" name="nombre" fieldSource="nombre" wizardCaption="Nombre" wizardSize="50" wizardMaxLength="50" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="certificadosnombre">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="11" fieldSourceType="DBColumn" dataType="Date" html="False" name="fecha" fieldSource="fecha" wizardCaption="Fecha" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="certificadosfecha">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="12" fieldSourceType="DBColumn" dataType="Text" html="False" name="sexo" fieldSource="sexo" wizardCaption="Sexo" wizardSize="1" wizardMaxLength="1" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="certificadossexo">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="13" fieldSourceType="DBColumn" dataType="Text" html="False" name="tipodoc" fieldSource="tipodoc" wizardCaption="Tipodoc" wizardSize="1" wizardMaxLength="1" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="certificadostipodoc">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="14" fieldSourceType="DBColumn" dataType="Text" html="False" name="nrodoc" fieldSource="nrodoc" wizardCaption="Nrodoc" wizardSize="15" wizardMaxLength="15" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="certificadosnrodoc">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Link id="15" visible="Yes" fieldSourceType="DBColumn" dataType="Text" html="False" hrefType="Page" urlType="Relative" preserveParameters="None" name="Link1" PathID="certificadosLink1" hrefSource="resultado.ccp" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="16" sourceType="DataField" format="yyyy-mm-dd" name="s_nro" source="nro"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</Link>
			</Components>
			<Events/>
			<TableParameters>
				<TableParameter id="18" conditionType="Parameter" useIsNull="False" field="nro" dataType="Text" searchConditionType="Equal" parameterType="URL" logicOperator="And" defaultValue="Z" parameterSource="s_protocolo"/>
			</TableParameters>
			<JoinTables>
			</JoinTables>
			<JoinLinks/>
			<Fields/>
			<SPParameters/>
			<SQLParameters>
				<SQLParameter id="19" parameterType="URL" variable="s_protocolo" dataType="Text" parameterSource="s_protocolo" defaultValue="Z" designDefaultValue="A570037"/>
				<SQLParameter id="20" variable="s_nrodoc" parameterType="URL" defaultValue="0" dataType="Text" parameterSource="s_nrodoc" designDefaultValue="adrian"/>
			</SQLParameters>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Grid>
	</Components>
	<CodeFiles>
		<CodeFile id="Code" language="PHPTemplates" name="certificados.php" forShow="True" url="certificados.php" comment="//" codePage="windows-1252"/>
	</CodeFiles>
	<SecurityGroups/>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events/>
</Page>
