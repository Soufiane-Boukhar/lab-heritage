<div class="form-group">
    <label for="exampleInputEmail1">Nom </label>
    <input name="nom" type="text" class="form-control"
        id="exampleInputEmail1" value="{{ isset($membre) ? $membre->nom : null}}">
</div>

<div class="form-group">
    <label for="exampleInputPassword1">Prenom</label>
    <input name="prenom" type="text" class="form-control"
        id="exampleInputPassword1" value="{{ isset($membre) ? $membre->prenom : null}}">
</div>

<div class="form-group">
    <label for="exampleInputPassword1">Email</label>
    <input name="email" type="email" class="form-control"
        id="exampleInputPassword2" value="{{ isset($membre) ? $membre->email : null}}">
</div>