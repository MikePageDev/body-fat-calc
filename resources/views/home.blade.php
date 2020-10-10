<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Body Fat Calculator</title>
</head>
<body>
  <header>
    <h1>Body Fat Calculator</h1>
  </header>
  <main>
    <section id="calc">
      <form action="{{ route('body_stats.result') }}" method="post">
        @csrf
        <div>
          <label for="date">Date:</label>
          <input type="date" name="date" id="date">
        </div>
        <div>
          <label for="wight">Wight:</label>
          <input type="number" name="wight" id="wight">
          <p>lb</p>
        </div>
        <div>
          <label for="fat">Fat:</label>
          <input type="number" name="fat" id="fat">
          <p>%</p>
        </div>
        <div>
          <label for="muscle">Muscle:</label>
          <input type="number" name="muscle" id="muscle">
          <p>%</p>
        </div>
        <div>
          <input class="btn" type="submit" value="Calc">
        </div>
      </form>
    </section>
    <section id="result">
      @if (isset($result))
        <h2>Result</h2>
        <p>Wight: {{ $result['wight'] }}lb</p>
        <p>Fat: {{ $result['fat_lb'] }}lb</p>
        <p>Muscle: {{ $result['muscle_lb'] }}lb</p>
        <form action="{{ route('body_stats.save') }}" method="post">
          @csrf
          @foreach ($result as $key =>$item)
          <input type="hidden" name="{{ $key }}" value="{{ $item }}">   
          @endforeach
          <input type="submit" value="Save">
        </form>
      @endif
    </section>
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