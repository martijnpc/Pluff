@if (!empty($klas))
<div class="row">
  @foreach(Lang::get('site.days') as $dagnr => $dagNaam)
  <div class="medium-3 columns">
    <div class="dag {{ (Bereken::getHuidigeDag($weeknr, $dagnr)) ? 'huidige-dag' : 'andere-dag' }} dag-{{ $dagnr }} {{ ($aankomende_dag != $dagnr) ? 'hide-for-small-only' : '' }}">
      <div class="naam">
        <h4>{{ $dagNaam }}</h4>
        <b class="datum">
          {{ date('d-m', Bereken::getTimestampVanWeeknrDagnr($weeknr, $dagnr)) }}
        </b>
      </div>

      @foreach (Bereken::getTijdenMin1() as $uurnr => $uurtijd)
      <?php $uurArray = Rooster::getUur($weeknr, $dagnr, $uurnr, $klas); ?>
      @if ($uurArray)
      <div class="uur">
        <div class="uur-nummer">{{ $uurnr }}</div>
        @foreach ($uurArray as $uur)
        @if ($uur)
        <b>{{{ date('H:i', strtotime($uur['tijdstip_begin'])) }}} - {{{ date('H:i', strtotime($uur['tijdstip_eind'])) }}}</b><br>
        {{{ $uur['vak'] }}} - <a href="/{{{ $uur['docent'] }}}" class="js-roosterlink undercover-link">{{{ $uur['docent'] }}}</a><br>
        <small>
          <a href="/{{{ $uur['lokaal'] }}}" class="js-roosterlink undercover-link">{{{ $uur['lokaal'] }}}</a> -
          <?php $klasArray = explode(';', $uur['klas']); $klasAantal = count($klasArray); $klasTellen = 0; ?>
          @foreach ($klasArray as $singleKlas)
          <a href="/{{{ $singleKlas }}}" class="js-roosterlink undercover-link">{{{ $singleKlas }}}</a>{{ (++$klasTellen === $klasAantal) ? '' : ', ' }}
          @endforeach
        </small><br>
        @endif
        @endforeach
      </div>
      @else
      <div class="uur uur-leeg">
        <div class="uur-nummer"> {{ $uurnr }}</div>
      </div>
      @endif
      <hr class="{{ ($uurnr === 14) ? 'hide' : '' }}">
      @endforeach
    </div>
  </div>
  @endforeach
</div>
@endif
