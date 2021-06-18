 <div class="categorias-container">
     <div style="display:flex; align-items: center; justify-content: center; margin-bottom: 20px">
         <h1 style="margin: 0">Lista de Categorias</h1>
         <button id="addCategoria" style="width: fit-content; align-self: center; border-radius: 50%; margin-left: 10px;">+</button>
     </div>
     <?php
        if (count($data) == 0) {
            echo "<p style:; >Nenhuma categoria cadastrada. </p>";
        }
        foreach ($data as $categorias) {
        ?>
         <div class="card-categorias">
             <?= $categorias->descricao ?>
             <div>
                 <img onclick="editarCategoria(<?= $categorias->id ?>)" style="width: 20px;" src="/imgs/edit.svg" />
                 
                 <img onclick="deletarCategoria(<?= $categorias->id ?>)" style="width: 20px;" src="https://icons.veryicon.com/png/o/construction-tools/coca-design/delete-189.png" />
             </div>
         </div>
     <?php
        }
        ?>
 </div>
 <script>
     function deletarCategoria(categoriaId) {
         if (confirm("Deseja realmente deletar esta categoria?"))
             window.location = `/categorias/destroy/${categoriaId}`;
     }

    function editarCategoria(categoriaId){ 
      window.location = `/categorias/edit/${categoriaId}`;
    }

     document.querySelector("#addCategoria").addEventListener("click", () => {
         window.location = "/categorias/create";
     })

 </script>