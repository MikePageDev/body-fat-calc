<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
  <title>Body Fat Calculator</title>
</head>
<a href="{{ route('body_stats.test') }}">test</a>
<body id="home">
  <header>
    <h1>Body Fat Calculator</h1>
  </header>
  <main>
    <section id="calc">
      <form class="calc_form" action="{{ route('body_stats.result') }}" method="post">
        @csrf
        <div>
          <div class="form_group">
            <label for="date">Date:</label>
            <input type="date" name="date" id="date">
          </div>
          @error('date')
            <p class="error">{{ $errors->first('date') }}</p>    
          @enderror
        </div>
        <div>
          <div class="form_group">
            <label for="wight">Wight:</label>
            <input type="number" name="wight" id="wight">
            <p>lb</p>
          </div>
          @error('wight')
            <p class="error">{{ $errors->first('wight') }}</p>    
          @enderror
        </div>
        <div>
          <div class="form_group">
            <label for="fat">Fat:</label>
            <input type="number" name="fat" id="fat">
            <p>%</p>
          </div>
          @error('fat')
            <p class="error">{{ $errors->first('fat') }}</p>    
          @enderror
        </div>
        <div>
          <div class="form_group">
            <label for="muscle">Muscle:</label>
            <input type="number" name="muscle" id="muscle">
            <p>%</p>
          </div>
          @error('muscle')
            <p class="error">{{ $errors->first('muscle') }}</p>    
          @enderror
        </div>
        <div>
          <input class="btn" type="submit" value="Calc">
        </div>
      </form>
    </section>
    @if (isset($result))
      <section id="result">
        <h2>Result</h2>
        <p>Wight: {{ $result['wight'] }}lb</p>
        <p>Fat: {{ $result['fat_lb'] }}lb</p>
        @if (isset($result['muscle_lb']))
          <p>Muscle: {{ $result['muscle_lb'] }}lb</p>
        @endif
        <form action="{{ route('body_stats.save') }}" method="post">
          @csrf
          @foreach ($result as $key =>$item)
          <input type="hidden" name="{{ $key }}" value="{{ $item }}">   
          @endforeach
          <input type="submit" value="Save">
        </form>
      </section>
    @endif
    <section id="table">
      <table>
        <tr>
          <th>Date</th>
          <th>Wight</th>
          <th>Fat %</th>
          <th>Fat lb</th>
          <th>Muscle %</th>
          <th>Muscle lb</th>
        </tr>
        @if (isset($pastResults))
          @foreach ($pastResults as $result)
            <tr>
              <td>{{ $result->date }}</td>
              <td>{{ $result->wight }}</td>
              <td>{{ $result->fat_percent }}</td>
              <td>{{ $result->fat_lb }}</td>
              <td>{{ $result->muscle_percent }}</td>
              <td>{{ $result->muscle_lb }}</td>
            </th>
          @endforeach
        @endif
      </table>
    </section>
  </main>
</body>
</html>