@extends('home')

@section('content')
    <section class="skill-list">
        <form class="addskill">
            <select id="optionSkill"> </select>
            <input type="number" name="position" id="position" placeholder="Position">
            <button id="addSkill">Select</button>
        </form>
        <p class="error"></p>
        <table class="table">
            <thead>
                <tr>
                    <th> STT </th>
                    <th>Skill name</th>
                    <th>Position</th>
                    <th></th>
                </tr>
            </thead>
            <tbody id="getSkillList"> </tbody>
        </table>
    </section>
@endsection
