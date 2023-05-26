<form action="{{ route('store') }}" method="post">
    @csrf
    Name
    <input type="text" name="name">
    <br>
    Gender
    <input type="radio" name="gender" value="1">Male
    <input type="radio" name="gender" value="0">Female
    <br>
    Birthdate
    <input type="date" name="birthdate">
    <br>
    <button>Create</button>
</form>
