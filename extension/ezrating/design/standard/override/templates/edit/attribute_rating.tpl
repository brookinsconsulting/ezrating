{default attribute_base=ContentObjectAttribute}
{let $classAttribute=$attribute.contentclass_attribute
     $min=$classAttribute.data_int1
     $max=$classAttribute.data_int2}


<input type="hidden" name="{$attribute_base}_data_integer_{$attribute.id}" value="0" />

{for $min to $max as $opt}
<input type="radio" class="ezcc-{$attribute.object.content_class.identifier} ezcca-{$attribute.object.content_class.identifier}_{$attribute.contentclass_attribute_identifier}" name="{$attribute_base}_data_integer_{$attribute.id}" value="{$opt}" {if $attribute.data_int|eq($opt)}checked="checked"{/if}/> {$opt}
    {for $min to $max as $i}
    {if $i|gt($opt)}
    <img src={"rating/star-empty.gif"|ezimage} />
    {else}
    <img src={"rating/star.gif"|ezimage} />
    {/if}
    {/for}
<br />
{/for}

{/let}

{/default}