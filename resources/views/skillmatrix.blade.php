@extends('home')

@section('content')
<section class="skills-matrix">
    <div class="title">
        <div class="level-list">
            <h2>Skills Matrix</h2>
            <div class="item">
                <div class="number" style="background-color: #ff33ff" value="-1">-1</div>
                <div class="desc">Chưa biết, không có nhu cầu học</div>
            </div>
            <div class="item">
                <div class="number" style="background-color: #990099"  value="0">0</div>
                <div class="desc">Chưa biết, có thời gian sẽ học</div>
            </div>
            <div class="item">
                <div class="number" style="background-color: #ff8080"  value="1">1</div>
                <div class="desc">Cần đào tạo thêm mới làm được</div>
            </div>
            <div class="item">
                <div class="number" style="background-color: #ff4d4d" value="2">2</div>
                <div class="desc">Có thể làm những task đơn giản</div>
            </div>
            <div class="item">
                <div class="number" style="background-color: #FFD567"  value="3">3</div>
                <div class="desc">Có thể làm được ngay</div>
            </div>
            <div class="item">
                <div class="number" style="background-color: #FFD567"  value="4">4</div>
                <div class="desc">Có kinh nghiệm</div>
            </div>
            <div class="item">
                <div class="number" style="background-color: #FFD567" value="5">5</div>
                <div class="desc">Expert</div>
            </div>
        </div>
    </div>
    <div>
        <table class="table">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Name</th>
                    @foreach ($skills as $skill)
                        <th value="{{ $skill->id }}"><p class="skill-name">{{ $skill->name }}</p></th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                <tr>
                    <td>{{ $loop->index + 1 }}</td>
                    <td>{{ $user->name }}</td>
                    @foreach ($skills as $skill)
                        <td>
                            <select name="" class="change-level" data-userid="{{$user->id}}" data-skillid="{{$skill->id}}">
                                <option selected="selected"> {{ $user->getLevel($skill->id) }} </option>
                                <option value="-1"> -1 </option>
                                <option value="0"> 0 </option>
                                <option value="1"> 1 </option>
                                <option value="2"> 2 </option>
                                <option value="3"> 3 </option>
                                <option value="4"> 4 </option>
                                <option value="5"> 5 </option> 
                            </select>
                            <input type="hidden" class="usersId" value="{{ $user-> id }}">
                            <input type="hidden" id="skillsId" value="{{ $skill-> id }}">
                            <form action="/getdata" method="POST">
                                @csrf
                                <input type="hidden" name="userid" value="2">
                                <input type="hidden" name="skillid" value="1">
                            </form>
                        </td>
                    @endforeach
                </tr>
                @endforeach
            </tbody>
        </table>
        {{ $users->withQueryString()->links('pagination')}}
    </div>
</section>

<div class="container">
    <!-- Modal -->
    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">
            <form class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Modal Header</h4>
                </div>
                <input type="hidden" name="userid" id="userId">
                <input type="hidden" name="skillid" id="skillId">
                <input type="hidden" name="number" id="number">
                <div class="modal-body">
                    <label for="time">Time</label>
                    <input type="number" name="time" id="time">
                    <p class="error"></p>
                </div>
                <div class="modal-footer">
                    <button id="submit">Submit</button>
                </div>
            </form>
        </div>
    </div>
    <!-- Modal -->
</div>

@endsection
