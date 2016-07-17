<Page id="1" templateExtension="html" relativePath="." fullRelativePath="." secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" isService="False" cachingEnabled="False" cachingDuration="1 minutes" wizardTheme="Simple" wizardThemeVersion="3.0">
	<Components>
		<Label id="2" fieldSourceType="DBColumn" dataType="Text" html="False" name="Label1" PathID="Label1">
<Components/>
<Events>
<Event name="BeforeShow" type="Server">
<Actions>
<Action actionName="Custom Code" actionCategory="General" id="3"/>
</Actions>
</Event>
</Events>
<Attributes/>
<Features/>
</Label>
<Link id="4" visible="Yes" fieldSourceType="DBColumn" dataType="Text" html="False" hrefType="Page" urlType="Relative" preserveParameters="GET" name="Link1" PathID="Link1" hrefSource="resultado.ccp" wizardUseTemplateBlock="False">
<Components/>
<Events/>
<LinkParameters/>
<Attributes/>
<Features/>
</Link>
</Components>
	<CodeFiles>
		<CodeFile id="Events" language="PHPTemplates" name="postmail_events.php" forShow="False" comment="//" codePage="windows-1252"/>
<CodeFile id="Code" language="PHPTemplates" name="postmail.php" forShow="True" url="postmail.php" comment="//" codePage="windows-1252"/>
</CodeFiles>
	<SecurityGroups/>
<CachingParameters/>
<Attributes/>
<Features/>
<Events/>
</Page>
