<br/><br/>
    </hr>
    <footer>
        <p>Copyright &copy; <?php echo date("Y"); ?> - Megabase Solutions Corp</p>
    </footer>
</div>

<script>
    $(document).ready(function(){
        $('.btnCancel').on('click', function(){
            urlTo = "<?php echo RESOURCE ;?>/<?php echo $activeController ;?>";
            window.location.replace(urlTo);
        });
    });
</script>

</body>
</html>