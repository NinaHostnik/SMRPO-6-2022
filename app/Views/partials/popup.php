<style>
    .popup{
        position: fixed;
        transition: 200ms ease-in-out;
        top: 0;
        left: 42%;
        transform: scale(0);
        border: 3px solid forestgreen;
        z-index: 9999;
        background-color: whitesmoke;
        width: 200px;
        max-width: 20%;
    }

    .popup.active{
        transform: scale(1);
        margin: 20px;
    }

    .popup_header{
        padding: 10px 15px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-bottom: 1px solid black;
    }

    .popup_body{
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
        pointer-events: none;
    }
</style>



<div class="popup active" id="popup">
    <div class="popup_body">
        <?php echo $popup ?>
    </div>
</div>
<div id="overlay" class="active"></div>

<script>
    const overlay = document.getElementById('overlay')

    overlay.addEventListener('click',() => {
        console.log('clicked')
        const popup = document.querySelectorAll('.popup.active')
        popup.forEach(popup=>{
            closePopup(popup)
        })
    })

    function closePopup(popup){
        if (popup != null){
            popup.classList.remove('active')
            overlay.classList.remove('active')
        }
    }
</script>