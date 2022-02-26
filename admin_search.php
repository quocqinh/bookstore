<?php
	session_start();
	require_once "./functions/admin.php";
	$title = "Search";
	require_once "./template/header.php";
	require_once "./functions/database_functions.php";
	$conn = db_connect();
    
?>
<div align="center">
            <form action="admin_search.php" method="get">
                Search: <input type="text" name="search" />
                <input type="submit" name="ok" value="search" />
            </form>
        </div>
        
	<table class="table" style="margin-top: 20px">
		<tr>
			<th>ISBN</th>
			<th>Title</th>
			<th>Author</th>
			<th>Image</th>
			<th>Description</th>
			<th>Price</th>
			<th>Publisher</th>
			<th>amount</th>
			<th>&nbsp;</th>
			<th>&nbsp;</th>
		</tr>
		<?php 
        if (isset($_REQUEST['ok'])) 
        {
            $search = addslashes($_GET['search']);
 
            if (empty($search)) {
                echo "Yeu cau nhap du lieu vao o trong";
            } 
            else
            {
                $query = "SELECT * FROM books WHERE book_isbn like '%$search%' or book_title like '%$search%' or book_author like '%$search%' or SL like '%$search%' ";
		        $result = mysqli_query($conn, $query);
                $num = mysqli_num_rows($result);
                if ($num > 0 && $search != "") 
                {
                    echo "$num kết quả trả về với từ khóa <b>$search</b>";
                    while($row = mysqli_fetch_assoc($result)){ ?>
		<tr>
			<td><?php echo $row['book_isbn']; ?></td>
			<td><?php echo $row['book_title']; ?></td>
			<td><?php echo $row['book_author']; ?></td>
			<td><?php echo $row['book_image']; ?></td>
			<td><?php echo $row['book_descr']; ?></td>
			<td><?php echo $row['book_price']; ?></td>
			<td><?php echo getPubName($conn, $row['publisherid']); ?></td>
			<td><?php echo $row['SL']; ?></td>
			<td><a href="admin_edit.php?bookisbn=<?php echo $row['book_isbn']; ?>">Edit</a></td>
			<td><a href="admin_delete.php?bookisbn=<?php echo $row['book_isbn']; ?>">Delete</a></td>
		</tr>
		<?php } 
            } else echo('');
        }
    }?>
	</table>

<?php
	if(isset($conn)) {mysqli_close($conn);}
	require_once "./template/footer.php";
?>