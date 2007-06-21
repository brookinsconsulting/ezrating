eZ rating extension for eZ publish
-----------------------------------

Example usage of the ezrating_summary template operator:

{def $rating_summary=ezrating_summary( $rating_class_attribute_id,$node.node_id )}

<p>
{for 1 to 5 as $i}
    {if $i|le($rating_summary.average_rating)}
        <img src={"rating/star.gif"|ezimage} />
    {elseif $i|sub(0.25)|le($rating_summary.average_rating)}
        <img src={"rating/star-three-fourth.gif"|ezimage} />
    {elseif $i|sub(0.5)|le($rating_summary.average_rating)}
        <img src={"rating/star-half.gif"|ezimage} />
    {elseif $i|sub(0.75)|le($rating_summary.average_rating)}
        <img src={"rating/star-one-fourth.gif"|ezimage} />
    {else}
        <img src={"rating/star-empty.gif"|ezimage} />
    {/if}
{/for}
</p>

<p>Average rating {$rating_summary.average_rating|l10n( 'number' )} by {$rating_summary.reviewer_count} reviewers.</p>

{if $rating_summary.reviewer_count|gt(1)}
<p>Lowest rating {$rating_summary.min_rating}, highest rating {$rating_summary.max_rating}.</p>
{/if}

{undef $rating_summary}