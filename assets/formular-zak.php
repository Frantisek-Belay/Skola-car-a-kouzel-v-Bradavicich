
<form  method="POST"> <!-- Metoda POST se zavolá PO ODESLÁNÍ FORMULÁŘE -->
    <input type="text"  
            name="first_name" 
            placeholder="Křestní jméno" 
            value="<?= htmlspecialchars($first_name) ?>"
            required> <!-- htmlspecialchars = ochrana proti XSS -->
    <br>
    <input type="text" 
            name="second_name" 
            placeholder="Příjmení" 
            value="<?= htmlspecialchars($second_name) ?>"
            required> <!-- htmlspecialchars = ochrana proti XSS -->
    <br>
    <input type="number" 
            name="age" 
            placeholder="Věk" 
            min="6" 
            max="99" 
            value="<?= htmlspecialchars($age) ?>"
            required> <!-- htmlspecialchars = ochrana proti XSS -->
    <br>
    
    <textarea name="life" 
                placeholder="Podrobnosti o žákovi" 
                cols="30" 
                rows="10"
                required><?= htmlspecialchars($life) ?> 
                </textarea> <!-- POZOR, TADY NESMÍ BÝT NEZI TAGY MEZERA! -->
                <!-- Mezera se projeví v poli jako prázdný prostor a PŘEKRYJE můj placeholder pro toto pole !! --> <!-- htmlspecialchars = ochrana proti XSS -->
                <!-- POZOR! <?= htmlspecialchars($life) ?> MUSÍ BÝT VLOŽENÝ MEZI TAGY!! -->
    <br>
    <input type="text" 
            name="college" 
            placeholder="Kolej" 
            value="<?= htmlspecialchars($college) ?>" 
            required> <!-- htmlspecialchars = ochrana proti XSS -->
   
    <!-- <select name="Kolej" id="" placeholder="Kolej" required >
        <optgroup label="Kolej" selected>
            <option label="havraspar">Havraspár</option>
            <option label="mrzimor">Mrzimor</option>
            <option label="nebelvír">Nebelvír</option>
            <option label="zmijozel">Zmijozel</option>
        </optgroup>
    </select> -->
    <br>
    <input type="submit" value="Uložit">
</form>