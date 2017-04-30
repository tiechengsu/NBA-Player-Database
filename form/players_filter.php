
	SELECT players WHERE
	<select name="filter">
		<option value="position">Position</option>
		<option value="height">Height</option>
		<option value="weight">Weight</option>
		<option value="team">Team</option>
	</select>
	<select name="operator">
		<option value="eq">==</option>
		<option value="noteq">!=</option>
		<option value="gt">></option>
		<option value="lt"><</option>
		<option value="gteq">>=</option>
		<option value"lteq"><=</option>
	</select>
	<input type="text" name="value">
	<input type="submit" value="filter">



