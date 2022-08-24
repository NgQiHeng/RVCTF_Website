<?php
//THIS NEEDS TO CHANGE IF YOU ARE USING SERVER
$servername = "localhost"; // for default: 127.0.0.1 
$username = "pjjabycm_ctfdb"; // for x10: pjjabycm_ctfdb | for others: root
$password = "q6sFckv3"; // for x10: q6sFckv3 
$db_name = "pjjabycm_ctfdb"; // for x10: pjjabycm_ctfdb 
// $servername = "127.0.0.1"; // for default: 127.0.0.1 
// $username = "root"; // for x10: pjjabycm_ctfdb | for others: root
// $password = ""; // for x10: q6sFckv3 
// $db_name = "ctfdb"; // for x10: pjjabycm_ctfdb 
$conn = new mysqli($servername,$username,$password,$db_name);
function prepared_query($mysqli, $sql, $params, $types = "")
{
    $stmt = $mysqli->prepare($sql);
    if ($stmt->bind_param($types, ...$params)===false){
        echo "parameter binding error";
    	return false;
    }
    if ($stmt->execute()===false){
        echo "Statement execution error";
    	return false;
    }
    return $stmt;
}

class iimysqli_result
{
    public $stmt, $nCols;
}   

function iimysqli_stmt_get_result($stmt)
{
    /**    EXPLANATION:
     * We are creating a fake "result" structure to enable us to have
     * source-level equivalent syntax to a query executed via
     * mysqli_query().
     *
     *    $stmt = mysqli_prepare($conn, "");
     *    mysqli_bind_param($stmt, "types", ...);
     *
     *    $param1 = 0;
     *    $param2 = 'foo';
     *    $param3 = 'bar';
     *    mysqli_execute($stmt);
     *    $result _mysqli_stmt_get_result($stmt);
     *        [ $arr = _mysqli_result_fetch_array($result);
     *            || $assoc = _mysqli_result_fetch_assoc($result); ]
     *    mysqli_stmt_close($stmt);
     *    mysqli_close($conn);
     *
     * At the source level, there is no difference between this and mysqlnd.
     **/
    $metadata = mysqli_stmt_result_metadata($stmt);
    $ret = new iimysqli_result;
    if (!$ret) return NULL;

    $ret->nCols = mysqli_num_fields($metadata);
    $ret->stmt = $stmt;

    mysqli_free_result($metadata);
    return $ret;
}

function iimysqli_result_fetch_array(&$result)
{
    $ret = array();
    $code = "return mysqli_stmt_bind_result(\$result->stmt ";

    for ($i=0; $i<$result->nCols; $i++)
    {
        $ret[$i] = NULL;
        $code .= ", \$ret['" .$i ."']";
    };

    $code .= ");";
    if (!eval($code)) { return NULL; };

    // This should advance the "$stmt" cursor.
    if (!mysqli_stmt_fetch($result->stmt)) { return NULL; };

    // Return the array we built.
    return $ret;
}

?>