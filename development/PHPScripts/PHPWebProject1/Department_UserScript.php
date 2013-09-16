<?php
//add department user link: increase department count
function linkDepartmentAndUser($conn, $id_department, $id_user)
{
	//connecting to the server and database
    //$conn = connectToDB();
    
    //Inserting a link into the database
    $insertQuery = "INSERT INTO [Department_User] (Department_id_department, User_id_user) 
                    VALUES (?,?)";
    $insertStatement = sqlsrv_query($conn, $insertQuery, array($id_deparment, $id_user));
    if($insertStatement===false){
        echo "Department to User link failed";
        die(print_r(sqlsrv_errors(), true));
    }
    //free statement and close database
    sqlsrv_free_stmt($insertStatement);
    //increase department size
    sqlsrv_close($conn);
}
//fetch all users linked with group
function getGroupMembers($conn, $id_department)
{
	//connect to the server
    //$conn = connectToDB();
    //select first five birthdays
    $selectQuery = "SELECT User_id_user FROM [Department_User]
                    WHERE Department_id_department = ?";
    $selectStatement = sqlsrv_query($conn, $selectQuery, array($id_department));
    if ($selectStatement === false)
    {
        sqlsrv_free_stmt($selectStatement);
        sqlsrv_close($conn);
    	return null;
    }
    $outputarray = array();
    while ($results = sqlsrv_fetch_array($selectStatement))
    {
        array_push($outputarray, $results[0]);
    }
    //free statement and close connection
    sqlsrv_free_stmt($selectStatement);
    sqlsrv_close($conn);
    return $outputarray;
}

//delete department user link
//fetch all groups linked with user

?>