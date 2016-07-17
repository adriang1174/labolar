<Page id="1" templateExtension="html" relativePath="." fullRelativePath="." secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" isService="False" cachingEnabled="False" cachingDuration="1 minutes" wizardTheme="Simple" wizardThemeVersion="3.0" showSyncDlg="false">
	<Components>
		<Record id="2" sourceType="Table" urlType="Relative" secured="False" allowInsert="False" allowUpdate="True" allowDelete="False" validateData="True" preserveParameters="GET" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" connection="Connection1" name="clave" dataSource="clave" errorSummator="Error" wizardCaption="Agregar/Editar Clave " wizardFormMethod="post" PathID="clave" activeCollection="TableParameters">
<Components>
<Button id="3" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Insert" operation="Insert" wizardCaption="Agregar" PathID="claveButton_Insert">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Button>
<Button id="4" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Update" operation="Update" wizardCaption="Enviar" PathID="claveButton_Update">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Button>
<Button id="5" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Delete" operation="Delete" wizardCaption="Borrar" PathID="claveButton_Delete">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Button>
<TextBox id="7" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="clave" fieldSource="clave" required="True" caption="Clave" wizardCaption="Clave" wizardSize="50" wizardMaxLength="200" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="claveclave">
<Components/>
<Events/>
<Attributes/>
<Features/>
</TextBox>
</Components>
<Events/>
<TableParameters>
<TableParameter id="6" conditionType="Expression" useIsNull="False" field="id" dataType="Integer" logicOperator="And" searchConditionType="Equal" parameterType="URL" orderNumber="1" expression="id = 1" parameterSource="id"/>
</TableParameters>
<SPParameters/>
<SQLParameters/>
<JoinTables>
<JoinTable id="8" tableName="clave" posLeft="10" posTop="10" posWidth="95" posHeight="88"/>
</JoinTables>
<JoinLinks/>
<Fields/>
<ISPParameters/>
<ISQLParameters/>
<IFormElements/>
<USPParameters/>
<USQLParameters/>
<UConditions/>
<UFormElements/>
<DSPParameters/>
<DSQLParameters/>
<DConditions/>
<SecurityGroups/>
<Attributes/>
<Features/>
</Record>
</Components>
	<CodeFiles>
		<CodeFile id="Code" language="PHPTemplates" name="clave.php" forShow="True" url="clave.php" comment="//" codePage="windows-1252"/>
</CodeFiles>
	<SecurityGroups/>
<CachingParameters/>
<Attributes/>
<Features/>
<Events/>
</Page>
