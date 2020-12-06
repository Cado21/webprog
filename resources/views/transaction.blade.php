@extends('layouts.app')

@section('styles')
@endsection

@section('content')
    <div class="container">
        @if (count($data))
            <table class="table">
                @foreach ($data as $transaction)
                    <thead class="thead-dark">
                        <tr>
                            <th colspan="3">{{ $transaction->created_at }}</th>
                            <th colspan="1">Total: Rp{{ number_format($transaction->total, 0, '.', '.') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($transaction->details as $detail)
                            <tr>
                                <th>{{ $detail->product->name }}</th>
                                <td>Rp{{ number_format($detail->price, 0, '.', '.') }}</td>
                                <td>Quantity: {{ $detail->quantity }}</td>
                                <td>Sub Total: Rp{{ number_format($detail->subtotal, 0, '.', '.') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                @endforeach
            </table>

        @else
            You don't have any transaction
        @endif


    </div>
@endsection
