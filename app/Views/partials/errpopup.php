<style>
    .errpopup{
        position: fixed;
        transition: 200ms ease-in-out;
        top: 0;
        left: 42%;
        transform: scale(0);
        border: 1px solid black;
        z-index: 9999;
        background-color: darkred;
        width: 200px;
        max-width: 20%;
    }

    .errpopup.active{
        transform: scale(1);
        margin: 20px;
    }

    .errpopup_header{
        padding: 10px 15px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-bottom: 1px solid black;
    }

    .errpopup_body{
        padding: 10px 15px;
    }

    #overlay{
        position: fixed;
        opacity: 0;
        top:0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: rgba(0,0,0,.20);
        pointer-events: none;
    }

    #overlay.active{
        opacity: 1;
        pointer-events: all;
    }
</style>



<div class="errpopup active" id="errpopup">
    <div class="errpopup_body">
        <?php echo $errpopup ?>
    </div>
</div>
<div id="overlay" class="active"></div>

<script>
    const overlay = document.getElementById('overlay')

    overlay.addEventListener('click',() => {
        console.log('clicked')
        const popup = document.querySelectorAll('.errpopup.active')
        popup.forEach(errpopup=>{
            closePopup(errpopup)
        })
    })

    function closePopup(errpopup){
        if (errpopup != null){
            errpopup.classList.remove('active')
            overlay.classList.remove('active')
        }
    }
</script>