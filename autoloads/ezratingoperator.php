<?php

class eZRatingOperator
{
    function eZRatingOperator()
    {
        $this->Operators = array( 'ezrating_summary' );
    }

    function operatorList()
    {
        return $this->Operators;
    }

    function namedParameterPerOperator()
    {
        return true;
    }

    function namedParameterList()
    {
        return array(
            'ezrating_summary' => array(
                'class_attribute_id' => array(
                    'type' => 'integer',
                    'required' => true ),
                'node_id' => array(
                    'type' => 'integer',
                    'required' => true )
            )
        );
    }

    function modify( $tpl, $operatorName, $operatorParameters, $rootNamespace, $currentNamespace, &$operatorValue, $namedParameters )
    {
        switch ( $operatorName )
        {
            case 'ezrating_summary':
            {
                $classAttrID = $namedParameters['class_attribute_id'];
                $nodeID = $namedParameters['node_id'];

                $db = eZDB::instance();

                $sql = "SELECT COUNT(a.data_int) AS reviewer_count, AVG(a.data_int) AS average_rating, MIN(a.data_int) AS min_rating, MAX(a.data_int) AS max_rating
                        FROM ezcontentobject_attribute a, ezcontentclass_attribute ca, ezcontentobject o, ezcontentobject_tree n
                        WHERE n.contentobject_id=o.id
                          AND n.parent_node_id=$nodeID
                          AND ca.id=$classAttrID
                          AND ca.version=0
                          AND a.contentclassattribute_id=ca.id
                          AND a.contentobject_id=o.id
                          AND a.version=o.current_version
                          AND o.published >= ALL (
                            SELECT o1.published
                            FROM ezcontentobject_tree n1, ezcontentobject o1
                            WHERE n1.contentobject_id=o1.id
                              AND o1.owner_id=o.owner_id
                              AND o1.contentclass_id=ca.contentclass_id
                              AND n1.parent_node_id=$nodeID)";

                $results = $db->arrayQuery( $sql );

                if ( count( $results ) > 0 )
                {
                    $operatorValue = $results[0];
                }

            } break;
        }
    }

    var $Operators;
}

?>
